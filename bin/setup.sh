#!/usr/bin/env bash
# One-time local setup: installs WordPress (Ukrainian), WooCommerce, activates the theme
# and creates demo categories, brands and featured products for the landing page.
#
# Run from the project root:
#   docker compose up -d
#   docker compose run --rm cli bash /bin-revive/setup.sh
#
# Local-only credentials (override with env vars). Never reuse these on a real server.
set -euo pipefail

SITE_URL="${SITE_URL:-http://localhost:8080}"
ADMIN_USER="${ADMIN_USER:-admin}"
ADMIN_PASS="${ADMIN_PASS:-revive-local-dev}"
ADMIN_EMAIL="${ADMIN_EMAIL:-admin@example.test}"

cd /var/www/html

echo "→ Waiting for the database…"
for i in $(seq 1 30); do
  wp db check >/dev/null 2>&1 && break
  sleep 2
done

if ! wp core is-installed >/dev/null 2>&1; then
  wp core install --url="$SITE_URL" --title="Revive" \
    --admin_user="$ADMIN_USER" --admin_password="$ADMIN_PASS" \
    --admin_email="$ADMIN_EMAIL" --skip-email
fi

echo "→ Language, permalinks, timezone"
wp language core install uk --activate || true
wp option update timezone_string "Europe/Kyiv"
wp option update blogdescription "beauty shop"
wp rewrite structure '/%postname%/' --hard

echo "→ WooCommerce"
wp plugin install woocommerce --activate
wp language plugin install woocommerce uk || true
wp theme activate revive-shop

wp option update woocommerce_default_country "UA"
wp option update woocommerce_currency "UAH"
wp option update woocommerce_currency_pos "right_space"
wp option update woocommerce_price_thousand_sep " "
wp option update woocommerce_price_decimal_sep ","
wp option update woocommerce_price_num_decimals 0
wp option update woocommerce_calc_taxes "no"
wp option update woocommerce_coming_soon "no"
# Guest checkout; optional account creation at checkout; no separate sign-up page
wp option update woocommerce_enable_guest_checkout "yes"
wp option update woocommerce_enable_checkout_login_reminder "no"
wp option update woocommerce_enable_signup_and_login_from_checkout "yes"
wp option update woocommerce_enable_myaccount_registration "no"
wp option update woocommerce_registration_generate_username "yes"
wp option update woocommerce_registration_generate_password "yes"
wp option update woocommerce_onboarding_profile '{"skipped":true}' --format=json
wp wc tool run install_pages --user="$ADMIN_USER" >/dev/null

if [ "$(wp wc product list --user="$ADMIN_USER" --format=count)" -gt 0 ]; then
  echo "→ Products already exist, skipping demo data."
  exit 0
fi

echo "→ Demo categories"
declare -A CAT
while IFS='|' read -r slug name; do
  CAT[$slug]=$(wp wc product_cat create --user="$ADMIN_USER" --name="$name" --slug="$slug" --porcelain)
done <<'EOF'
ochyshchennia|Очищення
syrovatky|Сироватки
kremy|Креми
spf|SPF
volossia|Волосся
EOF

HAS_BRANDS=0
if wp taxonomy get product_brand >/dev/null 2>&1; then HAS_BRANDS=1; fi

echo "→ Demo products (invented — replace with the real catalog)"
# slug|name|price|category|brand|featured|short description
while IFS='|' read -r slug name price cat brand featured desc; do
  id=$(wp wc product create --user="$ADMIN_USER" \
    --name="$name" --slug="$slug" --type=simple --status=publish \
    --regular_price="$price" --featured="$featured" \
    --manage_stock=true --stock_quantity=12 \
    --categories="[{\"id\":${CAT[$cat]}}]" \
    --short_description="$desc" --porcelain)
  if [ "$HAS_BRANDS" = 1 ]; then
    wp term create product_brand "$brand" --porcelain >/dev/null 2>&1 || true
    wp post term add "$id" product_brand "$brand" --by=name >/dev/null 2>&1 || true
  fi
  img="wp-content/themes/revive-shop/assets/img/products/$slug.jpg"
  if [ -f "$img" ]; then
    wp media import "$img" --post_id="$id" --title="$name" --alt="$name" --featured_image --porcelain >/dev/null
  fi
  echo "   #$id $name"
done <<'EOF'
vitamin-c-serum|Сироватка з вітаміном C 15%, 30 мл|1450|syrovatky|Lumen Derm|true|Антиоксидантна сироватка для рівного тону та сяйва шкіри.
ceramide-cream|Крем з керамідами для відновлення бар’єру, 50 мл|1180|kremy|Barrier Lab|true|Відновлює захисний бар’єр, зменшує відчуття стягнутості.
spf50-fluid|Флюїд SPF 50 для щоденного захисту, 50 мл|890|spf|Solea|true|Невагомий сонцезахисний флюїд без білих слідів.
gentle-cleanser|М’який очищуючий гель, 200 мл|640|ochyshchennia|Barrier Lab|true|Делікатно очищає, не пересушуючи шкіру.
retinol-night-cream|Нічний крем з ретинолом 0,3%, 30 мл|1620|kremy|Lumen Derm|true|Поступове оновлення шкіри. Рекомендуємо після консультації.
niacinamide-toner|Тонер з ніацинамідом 5%, 150 мл|720|ochyshchennia|Aqua Botanica|true|Вирівнює тон і текстуру, контролює жирний блиск.
lip-balm|Відновлювальний бальзам для губ, 15 мл|320|kremy|Aqua Botanica|true|Живить і захищає губи, зокрема після ін’єкційних процедур.
anti-hair-loss-shampoo|Шампунь проти випадіння волосся, 250 мл|980|volossia|Tricho Pro|true|Домашній етап програми трихолога.
EOF

wp rewrite flush --hard
echo
echo "✓ Done. Open $SITE_URL  (admin: $SITE_URL/wp-admin)"

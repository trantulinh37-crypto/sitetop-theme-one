# Deploy tự động cho sitetop.one

```
sửa code → git push origin main → GitHub webhook → deploy-webhook.php → git pull trên máy chủ
```

| Thứ | Giá trị |
|---|---|
| Repo | `trantulinh37-crypto/sitetop-theme-one` (public — bắt buộc, xem dưới) |
| Webhook | id `674797432`, sự kiện `push` |
| Endpoint | `https://sitetop.one/wp-content/themes/sitetop-theme-one/deploy-webhook.php` |
| Thư mục trên máy chủ | `/home/ykeosvwc/sitetop.one/wp-content/themes/sitetop-theme-one` |
| Secret | trong `deploy-config.php` (gitignore, quyền 600, **riêng** của sitetop.one) |

## Vì sao repo phải để public

Máy chủ chạy `git pull` không có thông tin đăng nhập GitHub. Repo private sẽ lỗi
`could not read Username`. Đây là lý do repo `sitetop-theme` của sitetop.net cũng để public.

## Kiểm tra sức khoẻ

```bash
gh api 'repos/trantulinh37-crypto/sitetop-theme-one/hooks/674797432/deliveries?per_page=5' \
  --jq '.[] | "\(.delivered_at) \(.event) status=\(.status_code)"'
```

⚠️ `deploy-webhook.php` luôn trả HTTP 200 kể cả khi `git pull` thất bại — status 200 ở
GitHub **không** đảm bảo deploy thành công. Muốn chắc thì kiểm commit thật trên máy chủ:

```bash
ssh -i ~/.ssh/azdigi_sitetop -p 2210 ykeosvwc@103.221.223.48 \
  'cd ~/sitetop.one/wp-content/themes/sitetop-theme-one && git log --oneline -1'
```

## Đừng nhầm với sitetop.net

sitetop.net dùng repo **`sitetop-theme`** riêng, webhook riêng (`661912052`), thư mục
`public_html/wp-content/themes/sitetop-theme`. Hai đường ống hoàn toàn tách biệt.

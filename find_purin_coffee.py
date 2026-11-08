import urllib.request, json, urllib.parse, ssl

ctx = ssl._create_unverified_context()
headers = {
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
    'Referer': 'https://www.flickr.com/'
}

terms = [
    "purin kissaten coffee",
    "Japanese pudding coffee",
    "pudding dalgona",
    "caramel flan espresso",
    "creme caramel latte"
]

count = 0
for t in terms:
    url = f"https://api.openverse.org/v1/images/?q={urllib.parse.quote(t)}&page_size=10"
    try:
        req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
        data = json.loads(urllib.request.urlopen(req, timeout=10).read().decode('utf-8'))
        for r in data.get('results', []):
            w, h = r.get('width', 0), r.get('height', 0)
            img_url = r.get('url', '')
            if w >= 800 and img_url.endswith(('.jpg', '.jpeg', '.png')):
                title = r.get('title', '')
                try:
                    req2 = urllib.request.Request(img_url, headers=headers)
                    with urllib.request.urlopen(req2, context=ctx, timeout=8) as resp:
                        img_bytes = resp.read()
                        if len(img_bytes) > 40000:
                            count += 1
                            out_p = f"public/images/purin_coffee_{count}.jpg"
                            open(out_p, 'wb').write(img_bytes)
                            print(f"[{count}] ({w}x{h}) {title} -> {out_p}")
                            if count >= 6:
                                break
                except Exception:
                    pass
        if count >= 6:
            break
    except Exception as e:
        print(e)


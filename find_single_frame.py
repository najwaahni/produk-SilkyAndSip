import urllib.request
import urllib.parse
import json

headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'}

queries = [
    "pudding coffee table",
    "flan coffee",
    "creme caramel coffee",
    "purin coffee",
    "coffee dessert table",
    "iced coffee dessert",
    "coffee and flan"
]

print("=== OPENVERSE SEARCH ===")
for q in queries:
    url = f"https://api.openverse.org/v1/images/?q={urllib.parse.quote(q)}&page_size=8"
    try:
        req = urllib.request.Request(url, headers=headers)
        with urllib.request.urlopen(req, timeout=10) as resp:
            data = json.loads(resp.read().decode('utf-8'))
            results = data.get('results', [])
            for r in results:
                w, h = r.get('width', 0), r.get('height', 0)
                img_url = r.get('url', '')
                if w >= 800 and img_url.endswith(('.jpg', '.jpeg', '.png')):
                    print(f"[{q}] ({w}x{h}) -> {r.get('title')} | {img_url}")
    except Exception as e:
        print(f"Error {q}: {e}")


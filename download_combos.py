import urllib.request, ssl

ctx = ssl._create_unverified_context()
headers = {
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    'Referer': 'https://www.flickr.com/'
}

urls = {
    "public/images/cand_combo1.jpg": "https://live.staticflickr.com/7908/45704199044_e7ffec1f05_b.jpg",
    "public/images/cand_combo2.jpg": "https://live.staticflickr.com/65535/48847221592_eecbcace44_b.jpg",
    "public/images/cand_combo3.jpg": "https://live.staticflickr.com/2605/3741108761_c6730dd5b9_b.jpg",
}

for path, url in urls.items():
    try:
        req = urllib.request.Request(url, headers=headers)
        with urllib.request.urlopen(req, context=ctx, timeout=10) as resp:
            data = resp.read()
            with open(path, 'wb') as f:
                f.write(data)
            print(f"Downloaded {path}: {len(data)} bytes")
    except Exception as e:
        print(f"Error {path}: {e}")

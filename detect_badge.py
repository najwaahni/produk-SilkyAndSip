from PIL import Image
import numpy as np

im = Image.open('public/images/stitch_original.jpg')
arr = np.array(im)

# Let's see the badge colors and coordinates
# Badge is brownish rounded pill
print("Image size:", im.size)
# Let's inspect rows 5 to 35, cols 5 to 80
badge_pixels = []
for y in range(5, 35):
    for x in range(5, 80):
        r, g, b = arr[y, x]
        # Brown badge color is around R: 120-160, G: 70-100, B: 30-60
        # Text "Save 15%" is white: R > 200, G > 200, B > 200
        if (100 < r < 180 and 40 < g < 110 and 20 < b < 80) or (r > 190 and g > 190 and b > 190 and x < 65 and y < 30):
            badge_pixels.append((x, y))

if badge_pixels:
    min_x = min(p[0] for p in badge_pixels)
    max_x = max(p[0] for p in badge_pixels)
    min_y = min(p[1] for p in badge_pixels)
    max_y = max(p[1] for p in badge_pixels)
    print(f"Badge bounds: x={min_x}..{max_x}, y={min_y}..{max_y} (count: {len(badge_pixels)})")


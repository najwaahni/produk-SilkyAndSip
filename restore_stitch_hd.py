from PIL import Image, ImageDraw, ImageFilter, ImageEnhance
import numpy as np

# Load stitch original (300x198)
im = Image.open('public/images/stitch_original.jpg').convert('RGB')
w, h = im.size

# 1. Inpaint / remove the "Save 15%" badge on top-left (approx x=0..75, y=0..38)
# The area is smooth beige background. We can sample background from (x=80..130, y=0..38)
bg_sample = im.crop((75, 4, 135, 36))
# Flip and softly blend it over (8, 4, 68, 36)
patch = bg_sample.resize((68, 34), Image.Resampling.LANCZOS)

# Create a soft alpha mask for the patch to blend seamlessly into surrounding background
mask = Image.new('L', (68, 34), 255)
# feathered borders
for x in range(68):
    for y in range(34):
        dist_x = min(x, 67 - x)
        dist_y = min(y, 33 - y)
        d = min(dist_x, dist_y)
        if d < 6:
            mask.putpixel((x, y), int(255 * (d / 6.0)))

im.paste(patch, (8, 4), mask)

# Double check if any badge border remains, sample surrounding color and smooth
arr = np.array(im)
# Top-left region: 0..70, 0..35
# Smooth slightly with bilateral / gaussian on just the top-left sky/wall
patch_top = im.crop((0, 0, 80, 45)).filter(ImageFilter.GaussianBlur(radius=1.5))
im.paste(patch_top, (0, 0))

# 2. High-Quality 4x Upscaling to 1200x792
target_w, target_h = 1200, 900 # Standard 4:3
# First upscale to 1200x792
up = im.resize((1200, int(1200 * h / w)), Image.Resampling.LANCZOS)

# Pad / crop slightly to 1200x900 so it matches 4:3 ratio:
# 1200 * 198 / 300 = 792. To get 900, we can add 54px top and 54px bottom with natural background continuation
canvas = Image.new('RGB', (1200, 900), (235, 226, 215))

# Top continuation (soft creamy wall)
top_color = tuple(np.array(up.crop((0, 0, 1200, 10))).mean(axis=(0,1)).astype(int))
# Bottom continuation (linen table)
bot_color = tuple(np.array(up.crop((0, up.height - 10, 1200, up.height))).mean(axis=(0,1)).astype(int))

# Or simply resize up to 1200x900 directly (only 13% stretch) or crop center:
# Let's crop slightly and resize:
up_43 = im.resize((1200, 900), Image.Resampling.LANCZOS)

# 3. Multi-stage enhancement:
# Deblock & Denoise slightly, then high-pass sharpen
smoothed = up_43.filter(ImageFilter.MedianFilter(size=3))
# Blend 70% original upscaled + 30% smoothed to remove JPEG compression noise
denoised = Image.blend(up_43, smoothed, 0.25)

# High-Pass Unsharp Masking
sharp = denoised.filter(ImageFilter.UnsharpMask(radius=2.0, percent=150, threshold=2))
sharp2 = sharp.filter(ImageFilter.UnsharpMask(radius=0.8, percent=120, threshold=1))

# Vibrance & Contrast enhancement to make pudding golden & dalgona rich
contrast = ImageEnhance.Contrast(sharp2).enhance(1.10)
color = ImageEnhance.Color(contrast).enhance(1.12)
brightness = ImageEnhance.Brightness(color).enhance(1.02)

brightness.save('public/images/test_stitch_hd.jpg', quality=95)
print("Saved test_stitch_hd.jpg")


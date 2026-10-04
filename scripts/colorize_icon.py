import sys
import os

# Set standard output encoding to utf-8 if possible
if sys.platform == 'win32':
    import io
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8', errors='replace')
    sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8', errors='replace')

def colorize(path):
    if not path or not os.path.exists(path):
        return

    ext = os.path.splitext(path)[1].lower()

    if ext == '.svg':
        try:
            with open(path, 'r', encoding='utf-8') as f:
                content = f.read()
            import re
            content = re.sub(r'stroke=["\'](#000000|#000|black)["\']', 'stroke="#EB3E35"', content, flags=re.I)
            content = re.sub(r'fill=["\'](#000000|#000|black)["\']', 'fill="#EB3E35"', content, flags=re.I)
            content = content.replace('currentColor', '#EB3E35')
            with open(path, 'w', encoding='utf-8') as f:
                f.write(content)
        except Exception:
            pass
        return

    try:
        from PIL import Image
        im = Image.open(path).convert('RGBA')
        r, g, b, a = im.split()

        # Check if transparent background
        get_alphas = getattr(a, 'get_flattened_data', getattr(a, 'getdata', None))
        alphas = list(get_alphas()) if get_alphas else []
        has_transparency = any(val < 250 for val in alphas)

        if has_transparency:
            # Simple tint: composite pure red with original alpha
            red_im = Image.new('RGBA', im.size, (235, 62, 53, 255))
            out = Image.composite(red_im, Image.new('RGBA', im.size, (0, 0, 0, 0)), a)
        else:
            # White background: convert white/light to transparent, dark to red
            pixels = im.load()
            width, height = im.size
            out = Image.new('RGBA', (width, height), (0, 0, 0, 0))
            out_pixels = out.load()
            for y in range(height):
                for x in range(width):
                    pr, pg, pb, pa = pixels[x, y]
                    brightness = (pr + pg + pb) / 3.0
                    if brightness < 240:
                        # Dark pixel -> make red
                        alpha = int(255 - brightness)
                        out_pixels[x, y] = (235, 62, 53, min(255, int(alpha * 1.5)))
                    else:
                        out_pixels[x, y] = (0, 0, 0, 0)

        # Save back to path
        if ext == '.webp':
            out.save(path, format='WEBP')
        elif ext in ['.jpg', '.jpeg']:
            out.save(path, format='PNG')
        else:
            out.save(path, format='PNG')
    except Exception:
        pass

if __name__ == '__main__':
    if len(sys.argv) > 1:
        colorize(sys.argv[1])

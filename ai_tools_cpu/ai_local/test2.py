from ollama import generate

# Generate an image with a text prompt
image = generate(
    model='llava:13b',
    prompt='A futuristic cityscape at sunset',
    max_tokens=1024
)
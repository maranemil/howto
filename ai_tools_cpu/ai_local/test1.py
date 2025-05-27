import ollama

res = ollama.chat(
	model="qwen3:0.6b",
	messages=[
		{
			'role': 'user',
			'content': 'Describe this image:',
			'images': ['./art.jpg']
		}
	]
)

print(res['message']['content'])
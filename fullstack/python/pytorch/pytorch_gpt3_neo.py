"""
https://www.youtube.com/watch?v=6MI0f6YjJIk

https://github.com/EleutherAI/gpt-neo
https://www.eleuther.ai/projects/gpt-neo/
https://pypi.org/project/pytorch-transformers/
https://pypi.org/project/pytorch-transformers/
https://github.com/EleutherAI/gpt-neox/
https://colab.research.google.com/drive/1UByjdT5l_VSsCBqtQvVygDexJYQ0pUma?usp=sharing

pip install torch torchvision
pip install pytorch-transformers

or

git clone https://github.com/EleutherAI/GPTNeo
cd GPTNeo
pip3 install -r requirements.txt
"""

from transformers import pipeline
generator = pipeline('text-generation',model='EleutherAI/gpt-neo-2.78')
promp = "what ist the future?"
res = generator(prompt, max_lenght=50, do_sample=True, temperature=0.9)
print (res[0]['generated_text'])
import numpy as np
import matplotlib.pyplot as plt
x = np.arange(0, 5, 0.1);
y = np.sin(x)
plt.plot(x, y)
plt.savefig("graph.png")

"""
import matplotlib.pyplot as plt
names = ['group_a', 'group_b', 'group_c']
values = [1, 10, 100]
plt.figure(1, figsize=(9, 3))
plt.subplot(131)
plt.bar(names, values)
plt.subplot(132)
plt.scatter(names, values)
plt.subplot(133)
plt.plot(names, values)
plt.suptitle('Categorical Plotting')
plt.savefig("graph.png")
"""

"""
# https://matplotlib.org/tutorials/introductory/pyplot.html
import matplotlib.pyplot as plt
import numpy as np
data = {'a': np.arange(50),
        'c': np.random.randint(0, 50, 50),
        'd': np.random.randn(50)}
data['b'] = data['a'] + 10 * np.random.randn(50)
data['d'] = np.abs(data['d']) * 100

plt.scatter('a', 'b', c='c', s='d', data=data)
plt.xlabel('entry a')
plt.ylabel('entry b')
plt.savefig("graph.png")
"""

"""
import pygal
xy_chart = pygal.XY(stroke=False,width=800,height=600)
xy_chart.title = 'Correlation'
xy_chart.add('A', [(0, 0), (.1, .2), (.3, .1), (.5, 1), (.8, .6), (1, 1.08), (1.3, 1.1), (2, 3.23), (2.43, 2)])
xy_chart.add('B', [(.1, .15), (.12, .23), (.4, .3), (.6, .4), (.21, .21), (.5, .3), (.6, .8), (.7, .8)])
xy_chart.add('C', [(.05, .01), (.13, .02), (1.5, 1.7), (1.52, 1.6), (1.8, 1.63), (1.5, 1.82), (1.7, 1.23), (2.1, 2.23), (2.3, 1.98)])
xy_chart.render_to_file('die_visual.svg')
"""

"""
import pygal
frequencies = [1,2,3,4,5]
results = [4,8,9,5,3]
for value in range(1, 1):
 frequency = results.count(value)
 frequencies.append(frequency)
hist = pygal.Bar(width=800,height=600)
hist.title = "Results of rolling one D6 1000 times."
hist.x_labels = [1, 2, 3, 4, 5, 6]
hist.x_title = "Result"
hist.y_title = "Frequency of Result"
hist.add('D6', frequencies)
hist.render_to_file('die_visual.svg')

# http://www.pygal.org/en/stable/documentation/types/bar.html
# http://www.pygal.org/en/stable/documentation/configuration/chart.html

"""

"""
import matplotlib.pyplot as plt
x_values = list(range(1001))
y_values = [x**2 for x in x_values]
plt.scatter(x_values, y_values, c=y_values, cmap=plt.cm.Blues,edgecolor='none', s=40)
plt.savefig('squares_plot.png', bbox_inches='tight')
"""

"""
import matplotlib.pyplot as plt
x_values = list(range(1, 1001))
y_values = [x**2 for x in x_values]
plt.scatter(x_values, y_values, s=40)
plt.axis([0, 1100, 0, 1100000])
plt.savefig("graph.png")
"""

"""
import matplotlib.pyplot as plt
x_values = [1, 2, 3, 4, 5]
y_values = [1, 4, 9, 16, 25]
plt.scatter(x_values, y_values, s=100)
plt.savefig("graph.png")
"""

"""
import matplotlib.pyplot as plt
plt.scatter(2, 4, s=200)
# Legt Diagrammtitel und Achsenbeschriftungen fest.
plt.title("Square Numbers", fontsize=24)
plt.xlabel("Value", fontsize=14)
plt.ylabel("Square of Value", fontsize=14)
# Legt die Größe der Teilstrichbeschriftungen fest.
plt.tick_params(axis='both', which='major', labelsize=14)
plt.savefig("graph.png")
"""

"""
import matplotlib.pyplot as plt
input_values = [1, 2, 3, 4, 5]
squares = [1, 4, 9, 16, 25]
plt.plot(input_values, squares, linewidth=5)
plt.savefig("graph.png")
"""

"""
import matplotlib.pyplot as plt
squares = [1, 4, 9, 16, 25]
plt.plot(squares, linewidth=5)
# Legt Diagrammtitel und Achsenbeschriftungen fest.
plt.title("Square Numbers", fontsize=24)
plt.xlabel("Value", fontsize=14)
plt.ylabel("Square of Value", fontsize=14)
# Legt die Größe der Teilstrichbeschriftungen fest.
plt.tick_params(axis="both", labelsize=14)
plt.savefig("graph.png")
"""

"""
import matplotlib.pyplot as plt
squares = [1, 4, 9, 16, 25]
plt.plot(squares)
plt.savefig("graph.png")
"""
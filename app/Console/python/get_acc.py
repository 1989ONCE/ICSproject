import pickle, os, sys

pkl = sys.argv[1]

# rb: 用2位元度入
path = os.getcwd() + "/models/" + pkl.strip()
with open(path, 'rb') as file:
    model = pickle.load(file)

accuracy = model.get('accuracy')
print('%.2f'%accuracy)
file.close()

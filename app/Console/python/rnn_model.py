import pandas as pd
import numpy as np
import pickle, warnings, os, sys
warnings.filterwarnings('ignore')
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'

# data order: (1)ph (2)ss
datas = sys.argv[1]
loc = sys.argv[2]

# rb: 用2位元度入
path = os.getcwd() + "/public/models/" + loc.strip()
with open(path, 'rb') as file:
    model = pickle.load(file)

# data processing
datas = datas[1:-1]+','
datas = datas.replace('[', '').replace(',', ' ').split(']')
data_arr = []
min_data = 9999
max_data = -1

for d in datas:
    temp_arr = []
    d = d.split(' ')
    for i in range(len(d)):
        if d[i] == "":
            continue
        else:
            num = float(d[i].strip())
            if i == 4:
                if num > max_data:
                    max_data = num
                elif num < min_data:
                    min_data = num

            temp_arr.append(num)
    if temp_arr:
        data_arr.append(temp_arr)

input = np.array(data_arr)
input2 = np.reshape(input, (1, 900, 6))

#array type
prediction = np.reshape(model.get('model').predict(input2, verbose=0), -1)
prediction *= (max_data-min_data) + min_data
print(prediction)
file.close()

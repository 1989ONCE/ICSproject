import modbus_tk.defines as modbus_defines
import modbus_tk.modbus_tcp as modbus_tcp
import csv
import time
from datetime import datetime
import concurrent.futures

def read_data(IP, PORT, header):
    master = modbus_tcp.TcpMaster(host=IP, port=PORT)
    start_address = 0
    register_count = 1

    try:
        data = master.execute(1, modbus_defines.READ_HOLDING_REGISTERS, start_address, register_count)
        data_list = list(data)
        return data_list

    except Exception as e:
        print('Modbus Error on port', PORT, ':', e)
        return None

if __name__ == "__main__":

    IP = '111.70.2.140'

    PORTS = [101, 102, 104, 105]

    common_header = ['Timestamp'] + [str(port) for port in PORTS]

    timestamp = datetime.now().strftime('%Y/%m/%d %H:%M:%S')
    results = [timestamp]

    with concurrent.futures.ThreadPoolExecutor(max_workers=len(PORTS)) as executor:
        data_results = list(executor.map(read_data, [IP] * len(PORTS), PORTS, [common_header] * len(PORTS)))

    for data in data_results:
        if data:
            results.extend(data)
        else:
            results.extend([''] * len(PORTS))  # 如果有誤，填入空值
    print(results)
import datetime
import struct
from modbus_tk import modbus_tcp
from modbus_tk.defines import READ_HOLDING_REGISTERS
import modbus_tk.defines as modbus_defines
import modbus_tk.modbus_tcp as modbus_tcp

def read_data(IP, PORT, slave_address, header):
    master = modbus_tcp.TcpMaster(host=IP, port=PORT)
    addresses_to_read = [0, 1]
    try:
        results = []

        data = master.execute(slave_address, modbus_defines.READ_HOLDING_REGISTERS, addresses_to_read[0], len(addresses_to_read))
        data_list = list(data)

        # REAL4(address0,1）
        real4_data = struct.unpack('f', struct.pack('H' * 2, *data_list[:2]))

        # 轉換單位：立方公尺/小時轉為立方公分/分鐘
        real4_data_abs = abs(real4_data[0])
        real4_data_min = (real4_data_abs * 1000000) / 60

        formatted_real4_data = f'{real4_data_min:.2f}'
        results.append([formatted_real4_data])

        return results

    except Exception as e:
        print(f'Modbus Error on port {PORT}: {e}')
        return None

if __name__ == "__main__":
    IP = '111.70.2.140'
    PORTS = 108

    common_header = ['Time', 'ID1', 'ID2']

    timestamp = datetime.datetime.now().strftime('%Y/%m/%d %H:%M:%S')
    results = []

    data_results_id1 = read_data(IP, PORTS, 1, common_header)
    data_results_id2 = read_data(IP, PORTS, 2, common_header)

    if data_results_id1 and data_results_id2:
        id1 = data_results_id1[0][0]
        id2 = data_results_id2[0][0]

        results.append([timestamp, id1, id2])
        print(results)

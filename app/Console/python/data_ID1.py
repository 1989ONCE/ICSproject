import datetime
import struct
from modbus_tk import modbus_tcp
from modbus_tk.defines import READ_HOLDING_REGISTERS
import modbus_tk.defines as modbus_defines
import modbus_tk.modbus_tcp as modbus_tcp

def read_data(IP, PORT, header):
    master = modbus_tcp.TcpMaster(host=IP, port=PORT)
    addresses_to_read = [0, 1, 8, 9]
    slave_address = 1
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
                
        address8 = str(data_list[2]).zfill(5)
        address9 = str(data_list[3]).zfill(5)
        long_data = address9 + address8
        results.append([formatted_real4_data, long_data])

        return results

    except Exception as e:
        print(f'Modbus Error on port {PORT}: {e}')
        return None

if __name__ == "__main__":
    IP = '111.70.2.140'

    PORTS = 108

    common_header = ['Time', 'ID1', 'ID1_all']

    timestamp = datetime.datetime.now().strftime('%Y/%m/%d %H:%M:%S')
    results = []

    data_results = read_data(IP, PORTS, common_header)
        
    if data_results:
        id1 = float(data_results[0][0])
        long_data = float(data_results[0][1])

        results.append([timestamp, id1, long_data])

        print(results)

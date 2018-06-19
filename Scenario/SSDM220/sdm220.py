#!/usr/bin/python2
import struct
import pymodbus.client.sync
import binascii
import time
import sys
import requests
 
def read_float_reg(client, basereg, unit=1) :
    resp = client.read_input_registers(basereg,2, unit=1)
    if resp == None :
        return None
    return struct.unpack('>f',struct.pack('>HH',*resp.registers))
 
def fmt_or_dummy(regfmt, val) :
    if val is None :
        return '.'*len(regfmt[2]%(0))
    return regfmt[2]%(val)
 
def main() :
    regs = [
        # Symbol    Reg#  Format
        ( 'V',      0x00, '%6.2f' ), # Voltage [V]
        ( 'Curr',   0x06, '%6.2f' ), # Current [A]
        ( 'P[act]', 0x0c, '%6.0f' ), # Active Power ("Wirkleistung") [W]
        ( 'P[app]', 0x12, '%6.0f' ), # Apparent Power ("Scheinl.") [W]
        ( 'P[rea]', 0x18, '%6.0f' ), # Reactive Power ("Blindl.") [W]
        ( 'PF',     0x1e, '%6.3f' ), # Power Factor   [1]
        ( 'Phi',    0x24, '%6.1f' ), # cos(Phi)?      [1]
        ( 'Freq',   0x46, '%6.2f' )  # Line Frequency [Hz]
    ]
 
    cl = pymodbus.client.sync.ModbusSerialClient('rtu',port='COM3', baudrate=2400, parity='N',stopbits=1,timeout=0.125)
 
    values = [ read_float_reg(cl, reg[1], unit=1) for reg in regs ]
    string = 'http://192.168.0.108/objects/?script=sdm220&volt=' + str(values[0]) + '&curr=' + str(values[1]) + '&p_act=' + str(values[2]) + '&p_app=' + str(values[3]) + '&p_rea=' + str(values[4]) + '&pf=' + str(values[5]) + '&phi=' + str(values[6]) + '&freq=' + str(values[7])
    string = string.replace(')', '')
    string = string.replace('(', '')
    string = string.replace(',', '')
    r = requests.get(string)
    sys.stdout.flush()
 
if __name__ == '__main__' :
    main()

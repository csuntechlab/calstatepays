#!/usr/bin/python

import sys
import getopt
import json
import os

#Get Command Line Arguments


def main(argv):
    input_file = ''
    output_file = ''

    dirname = os.path.dirname(__file__)
    input_file = os.path.join(dirname, '../main-major-output.json')
    output_file = ('northridge_hegis_codes.json')
    write_json(identify_category_id(read_json(input_file)), output_file)

    # populate_major_path_seeder(output_file)


#Read CSV File
def read_json(file):
    output_json = []
    with open(file, 'r') as master_data:
        master_json = json.load(master_data)
        for i in range(len(master_json)):
            temp_row = {
                'hegis_code': master_json[i]['hegis_at_exit'],
                'major': master_json[i]['major_at_exit']
            }
            output_json.append(temp_row)

        result = [dict(tupleized) for tupleized in set(
            tuple(item.items()) for item in output_json)]
    return result


def identify_category_id(data):
    for i in range(len(data)):
        hegis_category_id = data[i]['hegis_code']
        if len(str(hegis_category_id)) == 5:
            hegis_category_id = int(str(hegis_category_id)[:2])
            data[i].update({'hegis_category_id': hegis_category_id})
        else:
            hegis_category_id = int(str(hegis_category_id)[:1])
            data[i].update({'hegis_category_id': hegis_category_id})
    return data


def write_json(data, json_file):
    with open(json_file, "w") as f:
        f.write(json.dumps(data, sort_keys=False, indent=4, separators=(
            ',', ': '), encoding="utf-8", ensure_ascii=False))


if __name__ == "__main__":
   main(sys.argv[1:])

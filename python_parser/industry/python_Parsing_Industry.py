#!/usr/bin/python

import sys
import getopt
import csv
import json
import os

def main(argv):
    input_file = ''
    output_file = ''

    dirname = os.path.dirname(__file__)
    input_file = os.path.join(dirname, './main-industry-sheet.csv')
    output_file = ('master_industry_page_data.json')
    read_csv(input_file, output_file)


#Read CSV File
def read_csv(file, json_file):
    csv_rows = []
    parsed_titles = []
    # ignored_years = set((1, 3, 4, 6, 7, 8, 9, 11, 12, 13, 14))
    with open(file) as csvfile:
        reader = csv.DictReader(csvfile)
        title = reader.fieldnames
        parsed_titles = [add_underscores(title[i]) for i in range(len(title))]
        
        for row in reader:
            # Cast the data as ints/floats
            row['Campus'] = int(row['Campus'])
            row['Student Path'] = int(row['Student Path'])

            row['NAICS'] = remove_dollar(row['NAICS'])
            row['HEGIS At Exit'] = remove_dollar(row['HEGIS At Exit']) 
            
            row['Number of Students Found 5 Years After Exit'] = remove_dollar(row['Number of Students Found 5 Years After Exit'])
            row['Median Annual Earnings 5 Years After Exit'] = remove_dollar(row['Median Annual Earnings 5 Years After Exit'])
            row['Average Annual Earnings 5 Years After Exit'] = remove_dollar(row['Average Annual Earnings 5 Years After Exit'])

            csv_rows.extend([{parsed_titles[i]:row[title[i]] for i in range(
                len(title))}])

        csv_rows[:] = [row for row in csv_rows if row != {}]
        write_json(csv_rows, json_file)

# clean the csv titles


def add_underscores(input):
    return input.lower().replace(" ", "_")

# format the integers


def remove_dollar(input):
  if '*****' in input:
    return remove_star(input)
  else:
    if input == '':
        return None
    if "-" in input: 
        input = input.replace('-', '')
    if "+" in input:
        input = input.replace(' + ', '')
        print(input)
        input = input[0:5]
        print(input)
    dollar_less = input.replace("$", "")
  return int(round(float(dollar_less.replace(",", ""))))

def remove_star(input):
  input = None
  return input


# convert csv data into json and write it
def write_json(data, json_file):
    with open(json_file, "w") as f:
        f.write(json.dumps(data, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False))


if __name__ == "__main__":
   main(sys.argv[1:])
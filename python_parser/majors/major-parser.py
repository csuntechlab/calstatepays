#!/usr/bin/python

import sys
import getopt
import csv
import json
import os

#Get Command Line Arguments
def main(argv):
    input_file = ''
    output_file = ''

    dirname = os.path.dirname(__file__)
    input_file = os.path.join(dirname, './main-major-sheet.csv')
    output_file = ('main-major-output.json')
    read_csv(input_file, output_file)
    # populate_major_path_seeder(output_file)



#Read CSV File
def read_csv(file, json_file):
    csv_rows = []
    parsed_titles = []
    ignored_years = set((1,3,4,6,7,8,9,11,12,13,14))
    with open(file) as csvfile:
        reader = csv.DictReader(csvfile)
        title = reader.fieldnames
        parsed_titles = [add_underscores(title[i]) for i in range(len(title))]
       
        for row in reader:
            # Cast the data as ints
            row['Campus'] = int(row['Campus'])
            row['Year'] = int(row['Year'])
            row['Student Path'] = int(row['Student Path'])
            # row['HEGIS at Exit'] = int(row['HEGIS at Exit'])
            row['Potential Number of Students For Each Year Out of School'] = remove_dollar(row['Potential Number of Students For Each Year Out of School'])
            row['Average Earnings'] = remove_dollar(row['Average Earnings'])
            row['25th Percentile Earnings'] = remove_dollar(row['25th Percentile Earnings'])
            row['50th Percentile Earnings'] = remove_dollar(row['50th Percentile Earnings'])
            row['75th Percentile Earnings'] = remove_dollar(row['75th Percentile Earnings'])
            row['Potential Number of Students'] = remove_dollar(row['Potential Number of Students'])
            row['Number of Students Found'] = remove_dollar(row['Number of Students Found'])

            csv_rows.extend([{parsed_titles[i]:row[title[i]] for i in range(len(title)) if row['Year'] not in ignored_years}])
        
    
        csv_rows[:] = [row for row in csv_rows if row != {}]
        write_json(csv_rows, json_file)

# clean the csv titles
def add_underscores(input):
    return input.lower().replace(" ", "_")

# format the integers

def remove_dollar(input):
    if input == '':
        return None
    if "-" in input:
        input = input.replace('-', '')
    if "+" in input:
        input = input.replace(' + ', '')
    dollar_less = input.replace("$", "")
    return int(round(float(dollar_less.replace(",", ""))))

# convert csv data into json and write it
def write_json(data, json_file):
    with open(json_file, "w") as f:
        f.write(json.dumps(data, sort_keys=False, indent=4, separators=(',', ': '),encoding="utf-8",ensure_ascii=False))

if __name__ == "__main__":
   main(sys.argv[1:])
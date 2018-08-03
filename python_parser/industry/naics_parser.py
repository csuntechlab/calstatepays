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
    output_file = ('naics_titles_data.json')
    read_csv(input_file, output_file)


#Read CSV File
def read_csv(file, json_file):
    csv_rows = []
    parsed_titles = []
    # ignored_years = set((1, 3, 4, 6, 7, 8, 9, 11, 12, 13, 14))
    with open(file) as csvfile:
        reader = csv.DictReader(csvfile)
        title = reader.fieldnames
        title.append('image')
        parsed_titles = [add_underscores(title[i]) for i in range(len(title))]

        counter = 1
        absList = set()
        a = False
        b = False
        c = False
        
        for row in reader:
            # Cast the data as ints/floats
            row['NAICS'] = remove_dollar(row['NAICS'])

            row['image'] = '/images/industry/'+add_underscores(removeAmp (remove_commas(row ['Industry of Employment'] ) ) )+'.png'
            
            naics = row['NAICS']
            # naics = 'nacis_codes:'+str(naics)
            IndustryOfEmployment = row['Industry of Employment']
            # IndustryOfEmployment = 'industryOfEmployment:'+IndustryOfEmployment
            image = row['image']
            # image = ('image:'+row['image'])
            
            array = ()
            array = (naics,IndustryOfEmployment,image)
            # print (array)
            absList.add(array)
            # print(absList)

            csv_rows.extend([{parsed_titles[i]:row[title[i]] for i in range(
                len(title))}])

        # print(csv_rows)
        # write a set that covers each csv and then worrry about converting it to json
        csv_rows[:] = [row for row in csv_rows if row != {} ]
        # print(csv_rows)
        
        print(absList)
        absList = sanate(absList)
        json_maker(absList,json_file)
        # write_json(csv_rows, json_file)


def sanate(absList):
    d = {}
    l = []
    for i in absList:
        for a,b,c in absList:
            d = {'naics_codes':a,'naics_title':b,'image':c}
            l.append(d)
        break
    return l



def removeAmp(input):
    return input.replace(' &', '')



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

def remove_commas(input):
    if input == '':
        return None
    if "," in input: 
        input = input.replace(',', '')
    return input

# convert csv data into json and write it
def write_json(data, json_file):
    with open(json_file, "w") as f:
        f.write(json.dumps(data, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False))

def json_maker(data,json_file):
    lis = []
    for tup in data:
        lis.append(tup)
    with open(json_file, "w") as f:
        f.write(json.dumps(lis, sort_keys=True, indent=4, separators=(',', ': '), ensure_ascii=False))




if __name__ == "__main__":
   main(sys.argv[1:])

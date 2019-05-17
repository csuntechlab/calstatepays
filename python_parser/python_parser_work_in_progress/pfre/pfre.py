import os
from os import listdir
from os.path import isfile, join
import pandas as pd
import json
import simplejson
def main():
	path = os.getcwd()
	csvFiles = [csvFile for csvFile in listdir(path) 
				if isfile(join(path, csvFile)) 
				if '.csv' in csvFile]
	for csv in csvFiles:
		if csv == "Pfre.csv":
			os.remove("Pfre.csv")

	x = pd.read_csv(csvFiles[0])
	x = x[['guid', 'entry_status', 'major', 'in_school_earning', 'fin_aid_0', 'fin_aid_3000', 'fin_aid_10000']]
	x = filterDf(x)
	y = pd.read_csv(csvFiles[1])
	y = y[['guid', 'entry_status', 'major', 'in_school_earning', 'fin_aid_0', 'fin_aid_3000', 'fin_aid_10000']]
	y = filterDf(y)

	res = x.append(y)

	# print(res)
	res.to_csv("fre.csv", sep='\t', encoding='utf-8', index=False)

	filePath = '../../../database/data/pfre.json'
	res = res.to_dict(orient='record')
	with open (filePath, 'w' ) as fp:
		fp.write(simplejson.dumps(res, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
	fp.close()
	


def filterDf(df):
	jsonFile = open('../majorToId/aggregate.json')
	dictionary = jsonFile.read()
	dictionary = json.loads(dictionary)

	for index,row in df.iterrows():
			major = (str)(row.major)
			try:
				uni_majors_id = dictionary[major]
			except:
				uni_majors_id = "error"
				print(major)
			df.ix[index,'guid'] = uni_majors_id
	return df

	
if __name__ == "__main__": main()
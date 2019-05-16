import os
from os import listdir
from os.path import isfile, join
import pandas as pd

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
	y = pd.read_csv(csvFiles[1])
	y = y[['guid', 'entry_status', 'major', 'in_school_earning', 'fin_aid_0', 'fin_aid_3000', 'fin_aid_10000']]
	res = x.append(y)
	print(res)
	res.to_csv("Pfre.csv", sep='\t', encoding='utf-8', index=False)




	
if __name__ == "__main__": main()
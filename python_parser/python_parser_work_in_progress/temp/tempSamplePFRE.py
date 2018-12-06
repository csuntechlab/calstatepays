#!/usr/bin/env python
# coding: utf-8

import pandas as pd
import numpy as np


df = pd.read_csv("../Downloads/PFRE_Sample.csv")

# sanitize each column 
df.columns = df.columns.str.replace(' ', '_')
df.columns = map(str.lower, df.columns)
df.columns = df.columns.str.replace('_-_','_')

# sanitize estimated earnings after 5

df=df.rename(columns = {'estimated_time_to_degree_(years)':'estimated_time_to_degree'})
df=df.rename(columns = {'annual_financial_aid':'annual_financial_aid_id'})

df["estimated_earnings_5_years_after_exit"] = df["estimated_earnings_5_years_after_exit"].str.replace(" ",'')
df["estimated_earnings_5_years_after_exit"] = df["estimated_earnings_5_years_after_exit"].str.replace(",",'')

try:
    df["estimated_earnings_5_years_after_exit"] = df["estimated_earnings_5_years_after_exit"].str.replace('$', '')
except: 
    print('No dollars in the column')

df["estimated_earnings_5_years_after_exit"] = pd.to_numeric(df["estimated_earnings_5_years_after_exit"], errors='coerce')

df["estimated_earnings_5_years_after_exit"] = df["estimated_earnings_5_years_after_exit"].astype(int)


# remove % for SQL for ROI
df["fre_financial_return_on_education"] = df["fre_financial_return_on_education"].str.replace('%', '')


df['student_background_id'] = range(1, len(df) + 1)
df['annual_earnings_id'] = range(1, len(df) + 1)
df['id'] = range(1, len(df) + 1)

# delete $
# remove FA Range 
# ids are 0, 1, 2, 3, 4

try:
    df["annual_financial_aid_id"] = df["annual_financial_aid_id"].str.replace('$', '')
except: 
    print('No dollars in the column')
    
df["annual_financial_aid_id"] = df["annual_financial_aid_id"].str.replace('FA Range ', '')
df["estimated_earnings_5_years_after_exit"] = df["estimated_earnings_5_years_after_exit"].astype(int)
df["annual_financial_aid_id"] = df["annual_financial_aid_id"].astype(int)

df['annual_financial_aid'] = df['annual_financial_aid_id']


# key value 

annual_id_values = {0: "$0", 1: "$0 - $1,999", 2:"$2,000 - $3,999", 2:"$4,000 - $5,999",3:"$6,000 - $7,999",4:"$8000+"}

df = df.replace({"annual_financial_aid":annual_id_values})

import simplejson
output = df.to_dict(orient='record')

with open ('test.json', 'w' ) as fp:
  fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
fp.close()

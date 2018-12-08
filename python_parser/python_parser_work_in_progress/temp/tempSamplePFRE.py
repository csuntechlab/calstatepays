
import pandas as pd
import numpy as np

df = pd.read_csv("../Downloads/PFRE_Sample.csv")

# sanitize each column 
df.columns = df.columns.str.replace(' ', '_')
df.columns = map(str.lower, df.columns)
df.columns = df.columns.str.replace('_-_','_')


# sanitize estimated earnings after 5
df=df.rename(columns = {'estimated_time_to_degree_(years)':'estimated_time_to_degree'})

df["estimated_earnings_5_years_after_exit"] = df["estimated_earnings_5_years_after_exit"].str.replace(" ",'')
df["estimated_earnings_5_years_after_exit"] = df["estimated_earnings_5_years_after_exit"].str.replace(",",'')

try:
    df["estimated_earnings_5_years_after_exit"] = df["estimated_earnings_5_years_after_exit"].str.replace('$', '')
except: 
    print('No dollars in the column')

df["estimated_earnings_5_years_after_exit"] = pd.to_numeric(df["estimated_earnings_5_years_after_exit"], errors='coerce')


# remove % for SQL for ROI
df["fre_financial_return_on_education"] = df["fre_financial_return_on_education"].str.replace('%', '')
df.fre_financial_return_on_education = df.fre_financial_return_on_education.astype(float).fillna(0.0)


df['student_background_id'] = range(1, len(df) + 1)

# delete $
# remove FA Range 
# ids are 0, 1, 2, 3, 4


# replace the FA Range
df["annual_financial_aid"] = df["annual_financial_aid"].str.replace(' ', '')
FARange = {"$0":"$0", "FARange1": "$1 - $2,999", "FARange2":"$3,000 - $6,999", "FARange3":"$7,000 - $9,999","FARange4":"$10000+"}
df.annual_financial_aid = [FARange[item] for item in df.annual_financial_aid] 

df["annual_financial_aid_id"] = df["annual_financial_aid"]
finAidToID = {"$0":1,"$1 - $2,999":2,"$3,000 - $6,999":3,"$7,000 - $9,999":4, "$10000+":5}
df.annual_financial_aid_id = [finAidToID[item] for item in df.annual_financial_aid_id] 

# make a mapping id to annual earning during school
df["annual_earnings_during_school"] = df["annual_earnings_during_school"].str.replace('0 ', '0')
df["annual_earnings_during_school_id"] = df["annual_earnings_during_school"]
earingsToId = {"$0":1,"$1 - $4,500":2,"$4,501 - $10,500":3,"$10,501 - $18,000":4, "> $18,000":5}
df.annual_earnings_during_school_id = [earingsToId[item] for item in df.annual_earnings_during_school_id] 

# map years to an id
df["age_range_id"] = df["age_range"]
yearsToID = {"19 years or less":1,"20-23 years":2,"24-30 years":3, "More than 30 years":4}
df.age_range_id = [yearsToID[item] for item in df.age_range_id]


# make int
df["estimated_earnings_5_years_after_exit"] = df["estimated_earnings_5_years_after_exit"].astype(int)
df["annual_financial_aid_id"] = df["annual_financial_aid_id"].astype(int)
df["annual_earnings_during_school_id"] = df["annual_earnings_during_school_id"].astype(int)



# we will need to a way to map get the university major ID value and map it to the major/university is possible
# for example, 4011 biology northridge is row 81 in the university majors table
# recall the university major relationship is as follows
#    public function studentBackground(){
#        return $this->hasMany('App\Models\StudentBackground','university_major_id','id');
#    }
# ( foregin key, local key )

# hardcoded for sampling
df["university_majors_id"] = 81

df["investment_id"] = range(1, len(df) + 1)



import simplejson
output = df.to_dict(orient='record')

with open ('test.json', 'w' ) as fp:
  fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
fp.close()



# create fake data for all campuses for sanity purposes

all_df = df 
all_df.campus = 0
all_df.location = "all"

# get the amount of rows in the main dataframe

val = df.shape[0]
all_df["student_background_id"] += val
all_df["investment_id"] += val

all_df["university_majors_id"] = 372

output = all_df.to_dict(orient='record')
with open ('all_test.json', 'w' ) as fp:
  fp.write(simplejson.dumps(output, sort_keys=False, indent=4, separators=(',', ': '), ensure_ascii=False,ignore_nan=True))
fp.close()

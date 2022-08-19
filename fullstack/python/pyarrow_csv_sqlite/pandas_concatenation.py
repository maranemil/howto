##############################################################
#
#   Pandas dataframe concatenation with axis=1 : lost column names
#
##############################################################

# https://stackoverflow.com/questions/71805129/pandas-dataframe-concatenation-with-axis-1-lost-column-names

# Testing
# Merge, join, concatenate
# Pandas documentation : https://pandas.pydata.org/pandas-docs/stable/user_guide/merging.html

df1 = pd.DataFrame(
    {
        "A": ["A0", "A1", "A2", "A3"],
        "B": ["B0", "B1", "B2", "B3"],
        "C": ["C0", "C1", "C2", "C3"],
        "D": ["D0", "D1", "D2", "D3"],
    },
    # index=[0, 1, 2, 3],
)

df2 = pd.DataFrame(
    {
        "A": ["A4", "A5", "A6", "A7"],
        "B": ["B4", "B5", "B6", "B7"],
        "C": ["C4", "C5", "C6", "C7"],
        "D": ["D4", "D5", "D6", "D7"],
    },
    # index=[4, 5, 6, 7],
)

df3 = pd.DataFrame(
    {
        "E": ["E0", "E1", "E2", "E3", "E4", "E5"],
    },
    # index=[0, 1, 2, 3, 4 , 5],
)

frames = [df1, df2]
result_1 = pd.concat(frames, ignore_index=True)
print(result_1)

# frames = [result_1, df3]
# if "E" in df3.columns :
#   result_2 = pd.concat(frames, axis=1, ignore_index=True)
#   print(result_2)

# keep the column names
frames = [result_1, df3]
if "E" in df3.columns:
    result_2 = pd.concat(frames, axis=1)
    print(result_2)

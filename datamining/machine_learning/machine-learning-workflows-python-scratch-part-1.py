################################################################################################
#
# Machine Learning Workflows in Python from Scratch Part 1: Data Preparation
# https://www.kdnuggets.com/2017/05/machine-learning-workflows-python-scratch-part-1.html
# https://gist.github.com/mmmayo13/6edb1cdde4d25b2300ae1f077d61b165#file-ml-pipelines-1-2-py
# https://gist.github.com/mmmayo13/2f94bda7a8c3120c583a4c346255f554#file-ml-pipelines-1-3-py
# https://gist.github.com/mmmayo13/73c813c57b61971300883ae1c8f7597d#file-ml-pipelines-1-4-py
# https://gist.github.com/mmmayo13/6443658bb7a0e97b9980dad0e4263d45#file-ml-pipelines-1-5-py
#
################################################################################################

# -------------------------------
"""

import pandas as pd
df = pd.read_csv('iris.csv')
df.head()

# -------------------------------

import pandas as pd

def load_dataset(filename, filetype='csv', header=True):

    '''
    Loads a dataset from file

    Parameters:
    -----------
    filename: str
        Name of data file
    filetype: str
        The type of data file (csv, tsv)

    Returns:
    --------
    DataFrame
        Dataset as pandas DataFrame
    '''

    in_file = open(filename)
    data = []
    header_row = ''

    # Read the file line by line into instance structure
    for line in in_file.readlines():

        # Skip comments
        if not line.startswith("#"):

            # TSV file
            if filetype == 'tsv':
                if header:
                    header_row = line.strip().split('\t')
                else:
                    raw = line.strip().split('\t')

            # CSV file
            elif filetype =='csv':
                if header:
                    header_row = line.strip().split(',')
                else:
                    raw = line.strip().split(',')

            # Neither = problem
            else:
                print 'Invalid file type'
                exit()

            # Append to dataset appropriately
            if not header:
                data.append(raw)
            header = False

    # Build a new dataframe of the data instance list of lists and return
    df = pd.DataFrame(data, columns=header_row)
    return df




# -------------------------------


def to_numeric(dataset, attr_name):

    '''
    Performs a simple categorical to numeric attribute value transformation

    Parameters:
    -----------
    dataset: DataFrame
        Dataset on which to perform transformation
    attr_name: str
        Dataset attribute name to convert from nominal to numeric values

    Returns:
    --------
    DataFrame
        DataFrame with data transformation performed
    dict
        Python dictionary of attribute name to integer mappings
    '''

    # Get unique entries in column
    unique_vals = dataset[attr_name].unique()

    # Create dict
    val_dict = {}
    for val in unique_vals:
        if not val in val_dict:
            val_dict[val] = len(val_dict)

    # Replace values in attr_name col as per dict
    dataset[attr_name].replace(val_dict, inplace=True)

    # Return dataset and value dictionary
    return dataset, val_dict

# -------------------------------


import numpy as np
def to_matrix(dataset):

    '''
    Converts a pandas DataFrame dataset to a numpy matrix representation

    Parameters:
    -----------
    dataset: DataFrame
        Dataset to convert to matrix representation

    Returns:
    --------
    ndarray
        numpy ndarray representation of dataset
    '''

    return dataset.as_matrix()

# -------------------------------

# Load dataset
data = load_dataset('iris.csv')
print data.head()
# Change categorical class names to numeric values
data, data_dict = to_numeric(data, 'species')
print data.head()
print data_dict
# Convert dataset to matrix representation
ds = to_matrix(data)
print ds[:10]


"""
















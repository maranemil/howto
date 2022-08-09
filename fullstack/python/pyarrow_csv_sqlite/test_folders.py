import os


def set_test_dirs(path_dir):
    if os.path.isdir(path_dir):
        print("continue ...")
    else:
        os.mkdir(path_dir)


def getDbDir():
    return db_path


def getTestDir():
    return path


# if __name__ == '__main__':
path = 'tests/'
db_path = 'db/'
set_test_dirs(path)
set_test_dirs(db_path)

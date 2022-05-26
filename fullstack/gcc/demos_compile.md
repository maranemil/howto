~~~
############################################################
#
#   pisplay
#   https://github.com/santosoj/pisplay
#
############################################################

https://code.visualstudio.com/docs/setup/linux
https://www.monodevelop.com/download/
sudo apt install monodevelop

sudo snap install --classic code # or code-insiders
sudo apt-get install -f
sudo apt-get install apt-transport-https
sudo apt-get update
sudo apt-get install code # or code-insiders


sudo apt install libsdl2-dev
sudo apt install libsdl1.2-dev
sudo apt install libsdl2-ttf-dev
#sudo apt install emscripten
sudo apt install emscripten -y

sudo apt install build-essential
sudo apt-get install manpages-dev
sudo apt install gcc
gcc --version

sudo apt install software-properties-common
sudo apt install gcc-7 gcc-8 gcc-9 gcc-10
sudo apt install gcc-7 g++-7 gcc-8 g++-8 gcc-9 g++-9
reboot

gcc cube.c `pkg-config --cflags --libs sdl2`
gcc cube.c `pkg-config --cflags --libs sdl`

https://emscripten.org/docs/building_from_source/verify_emscripten_environment.html
https://webassembly.org/getting-started/developers-guide/
https://emscripten.org/docs/getting_started/downloads.html
https://emscripten.org/docs/tools_reference/emsdk.html
https://hub.docker.com/r/trzeci/emscripten/
https://lipn.univ-paris13.fr/~cerin/HDU/emscripten.html
https://gribblelab.org/CBootCamp/A2_Parallel_Programming_in_C.html
https://chromium.googlesource.com/external/github.com/kripken/emscripten/+/refs/heads/master/emcc.py
https://linuxize.com/post/how-to-install-gcc-compiler-on-ubuntu-18-04/
https://emscripten.org/docs/getting_started/FAQ.html

git clone https://github.com/emscripten-core/emsdk.git
cd emsdk
./emsdk install latest
./emsdk activate latest
source ./emsdk_env.sh

./emsdk list
emsdk list --old
./emsdk update
./emsdk update-tags

emsdk install latest
emsdk activate latest
emsdk install latest-upstream
./emsdk install sdk-upstream-master-64bit


which emcc
cd /home/demo/Git/emsdk/emscripten/1.38.30/emcc
./emcc -v
./emcc --clear-cache
emcc -s ENVIRONMENT=web
#/emcc tests/hello_world.c -o hello_world.html

python -m http.server
python -m SimpleHTTPServer


dpkg -L llvm-10 | grep /usr/bin/ | sort
sudo apt install llvm
sudo ln -s /usr/bin/llvm-ar-10 /usr/bin/llvm-ar
sudo ln -s /usr/bin/opt-10 /usr/bin/opt
dpkg -L llvm-10-runtime | grep /usr/bin/ | sort
sudo ln -s /usr/bin/lli-10 /usr/bin/lli
sudo ln -s /usr/bin/lli-10 /home/demo/Git/emsdk/upstream/bin/lli
emcc

LLVM version appears incorrect (seeing "11.0", expected "9.0")


sudo apt-get install libtinfo
sudo apt-get install ncurses-compat-libs


#sudo apt-get install python2.7-minimal
sudo apt install python
sudo apt install mlocate
which python
locate python

/usr/bin/python2.7
/usr/bin/python3
/usr/bin/python3.8

emcc --version

Run "git pull" followed by "./emsdk update-tags" to pull in the latest list.

./emsdk install emscripten-1.38.30
./emsdk activate emscripten-1.38.30

sudo ln -s /usr/lib/emscripten/emcc /usr/local/bin/
sudo ln -s /usr/lib/emscripten/emcc.py /usr/local/bin/
~~~

~~~
------------------------------------------------------
MISC
------------------------------------------------------
https://ftp.modland.com/pub/documents/format_documentation/
ftp://ftp.modland.com/pub/modules/Ad%20Lib/Beni%20Tracker/
http://fileformats.archiveteam.org/wiki/Beni_Tracker_module
https://github.com/santosoj/pisplay

https://sol.gfxile.net/demos.html
http://tmdc.scene.org/
http://www.taat.fi/tmdc/
https://demozoo.org/productions/179671/
https://www.pouet.net/prod.php?which=51945
https://www.pouet.net/mirrors.php?which=51945
http://janeway.exotica.org.uk/author.php?id=37341
http://janeway.exotica.org.uk/author.php?id=37341
https://bisqwit.iki.fi/source/opl3emu.html
https://chipmusic.org/
https://doomwiki.org/wiki/OPL_emulation
https://github.com/thp/oplfm
https://github.com/Malvineous/pyopl
https://pypi.org/project/PyOPL/
http://alcatraz.untergrund.net/index.php?site=productions
http://tnd64.unikat.sk/download_demos.html
https://minecraft.gamepedia.com/Music_Disc
https://csdb.dk/scener/?id=1066&sort=votes
https://csdb.dk/release/?id=89681
https://files.scene.org/search/?q=temp
https://files.scene.org/view/demos/compos/tmdcxi/00.tmdc_template/tmdc-template.zip
http://tmdc.scene.org/tmdc20/
http://tmdc.scene.org/tmdc15/
----------------------------------------
https://github.com/sahana-r/researchproj
https://download.virtualbox.org/virtualbox/6.1.6/
----------------------------------------
py2exe php2exe
https://deneskellner.com/sw/rapidexe####
https://code.ivysaur.me/php2exe####
https://github.com/entrypass/nightrain-ep
https://www.exeoutput.com/
https://deneskellner.com/sw/rapidexe
https://www.softpedia.com/get/Programming/Other-Programming-Files/RapidEXE.shtml
https://github.com/jaredallard/phc-win
https://github.com/kjellberg/nightrain
https://github.com/cztomczak/phpdesktop
http://wiki.swiftlytilting.com/Phc-win
https://github.com/xZero707/Bamcompile/
https://github.com/devsense/phalanger
https://github.com/DEVSENSE/Phalanger
http://v4.php-compiler.net/
https://github.com/peachpiecompiler/peachpie
https://www.peachpie.io/
https://docs.python-guide.org/shipping/freezing/
https://www.pyinstaller.org/
https://www.py2exe.org/index.cgi/Tutorial
https://pypi.org/project/py2exe/
https://pypi.org/project/auto-py-to-exe/
~~~

~~~
------------------------------------------------------
cmake
------------------------------------------------------

emcc --clear-cache
/home/deos/Git/emsdk/emscripten/1.38.30/emcc --clear-cache

.\emsdk install clang-incoming-64bit emscripten-incoming-64bit binaryen-master-64bit upstream-clang-master-64bit --vs2017
emcc -v
wasm-opt --version
./emsdk install clang-incoming-64bit emscripten-incoming-64bit binaryen-master-64bit upstream-clang-master-64bit --vs2017

./emsdk install clang-tag-e1.38.31-32bit emscripten-master-64bit binaryen-master-64bit fastcomp-clang-master-64bit    sdk-upstream-master-64bit sdk-fastcomp-master-64bit --vs2017

https://emscripten.org/docs/compiling/WebAssembly.html?highlight=wasm
https://emscripten.org/docs/getting_started/downloads.html
https://emscripten.org/docs/contributing/developers_guide.html
https://github.com/emscripten-core/emsdk


[Errno 2] No such file or directory: 'cmake'
Could not run CMake, perhaps it has not been installed?
Installing this package requires CMake. Get it via your system package manager (e.g. sudo apt-get install cmake), or from http://www.cmake.org/

sudo apt-get install cmake
https://www.cyberciti.biz/faq/how-to-check-kvm-qemu-kvm-version-in-linux/
~~~

~~~
############################################################
#
#   web players
#
############################################################

https://github.com/wdebeaum/xm-player
https://github.com/deskjet/chiptune2.js
https://www.warmplace.ru/soft/sunvox/jsplay/

https://fmod.com/resources/documentation-api?version=2.0&page=platforms-html5.html
https://github.com/santosoj/pisplay
~~~



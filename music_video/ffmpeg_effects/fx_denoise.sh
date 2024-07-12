# Fix Noisy Grainy Footage with FFmpeg by LinuxCreative
# https://www.youtube.com/watch?v=I9-VEUs1ZsE


# https://ffmpeg.org/ffmpeg-filters.html
# https://trac.ffmpeg.org/wiki/DenoiseExamples



ffmpeg -i in.mp4 -vf "atadenoise,hqdn3d=4,unsharp=7:7:0:5" out.mp4

#͏"atadenoise": Adaptive Temporal-Averaging denoiser
#͏"bm3d": Block-Matching 3D denoiser
#͏"chromanr": Reduces chrominance noise
#͏"dctdnoiz": Discrete Cosine Transform 2D denoiser
#͏"fftdnoiz": Fast Fourier Transform 3D denoiser
#͏"hqdn3d": High-quality 3D denoiser
#͏"nlmeans": Non-Local Means denoiser
#͏"owdenoise": Overcomplete-wavelet denoiser
#͏"removegrain": Spatial denoiser for progressive video
#͏"tmedian": Reduces noise by picking median pixels from several successive input video frames
#͏"tmix": Reduces noise by mixing successive video frames
#͏"vaguedenoiser": Wavelet-based denoiser
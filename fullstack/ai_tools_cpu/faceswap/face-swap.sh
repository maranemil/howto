# curl -s -X POST \
#   -H "Content-Type: application/json" \
#   -d $'{
#     "input": {
#       "swap_image": "https://replicate.delivery/pbxt/KYU956lXBNWkoblkuMb93b6CX8SFL2nrJTvv2T89Dm3DLhsW/swap%20img.jpg",
#       "input_image": "https://replicate.delivery/pbxt/KYU95NKY092KYhmCDbLLOVHZqzSC27D5kQLHDb28YM6u8Il1/input.jpg"
#     }
#   }' \
#   http://localhost:5000/predictions

IN="https://replicate.delivery/pbxt/KYU956lXBNWkoblkuMb93b6CX8SFL2nrJTvv2T89Dm3DLhsW/swap%20img.jpg"
FACE="https://replicate.delivery/pbxt/KYU95NKY092KYhmCDbLLOVHZqzSC27D5kQLHDb28YM6u8Il1/input.jpg"

  curl -v -s -X POST \
  -H "Content-Type: application/json" \
  -d $'{
    "input": {
      "swap_image": "'$IN'",
      "input_image": "'$FACE'"
    }
  }' \
  http://localhost:5000/predictions | jq . > face-swap.json

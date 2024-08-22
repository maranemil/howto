## declare an array variable
declare -a arr=(
"https://dummyjson.com/test"
"https://jsonplaceholder.typicode.com/todos/1"
)
## now loop through the above array
for i in "${arr[@]}"
do
   echo "$i"
   #curl --ipv4 --http1.1 2>/dev/null  "$i" | jq -c
   #curl --ipv4 --http1.1 2>/dev/null  "$i" | jq type | xargs -I {} bash -c "if [[ '{}' = object ]]; then echo '{}'; else echo 'err'; fi "
   curl --ipv4 --http1.1 2>/dev/null  "$i" | jq type | grep object
   # or do whatever with individual element of the array
done
# You can access them using echo "${arr[0]}", "${arr[1]}" also

#https://stackoverflow.com/questions/8880603/loop-through-an-array-of-strings-in-bash
#https://stackoverflow.com/questions/46954692/check-if-string-is-a-valid-json-with-jq
#https://stackoverflow.com/questions/40396445/get-outputs-from-jq-on-a-single-line
#https://stackoverflow.com/questions/53437665/bash-comparing-names-using-xargs-and-if-statement
#https://unix.stackexchange.com/questions/450944/bash-loop-through-list-of-strings

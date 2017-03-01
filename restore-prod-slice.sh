SLICE='/usr/local/scripps.sql' # location of slice on server
TMP='/tmp/slice.sql' # temporary location of slice locally

echo "Downloading slice file.."
scp -r demo:$SLICE $TMP # grab the file from the server

echo "Dropping database scripps"
psql -q -c "DROP DATABASE scripps"

psql -q -c "CREATE DATABASE scripps"
echo "Importing from slice file.."
psql -q -o /dev/null scripps < $TMP

rm -rf $TMP # remove the temporary file

PROFILE='/usr/local/profile.tar.gz' # location of slice on server

rm -rf uploads/profile

echo "Downloading profile photos.."
scp -r demo:$PROFILE uploads/profile.tar.gz # grab the file from the server
tar -xzf uploads/profile.tar.gz -C uploads/
rm -rf uploads/profile.tar.gz

echo "Restore Complete"

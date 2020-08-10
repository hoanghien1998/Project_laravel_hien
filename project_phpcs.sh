# files=$(git ls-files -om --exclude-standard)
files=$(git diff --name-only --staged)

if [ -z "$files" ]; then
    echo 'No files to check';
else
    ./vendor/bin/phpcs $files
fi

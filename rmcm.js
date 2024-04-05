const fs = require('fs');

// Function to remove comments from SQL
function removeComments(sql) {
    // Regular expression to match comments
    const commentRegex = /\/\*[\s\S]*?\*\/|(--[^\r\n]*)|(#.*)/gm;
    return sql.replace(commentRegex, '');
}

// Main function
function main() {
    // Check if a filename is provided as argument
    if (process.argv.length < 3) {
        console.error('Usage: node script.js <filename.sql>');
        process.exit(1);
    }

    // Get filename from command line argument
    const filename = process.argv[2];

    // Read SQL file
    fs.readFile(filename, 'utf8', (err, data) => {
        if (err) {
            console.error('Error reading file:', err);
            process.exit(1);
        }

        // Remove comments
        const sqlWithoutComments = removeComments(data);

        // Write SQL without comments back to the file
        fs.writeFile(filename, sqlWithoutComments, 'utf8', (err) => {
            if (err) {
                console.error('Error writing file:', err);
                process.exit(1);
            }
            console.log(`Comments removed from ${filename}`);
        });
    });
}

// Run the script
main();

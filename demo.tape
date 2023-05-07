# Where should we write the GIF?
Output phpunit-slicer/demo.gif

# Set up a 1200x600 terminal with 46px font.
Set FontSize 28
Set Width 1200
Set Height 600
Set WindowBar Colorful

Hide
Type "cd phpunit-slicer"
Enter
Show

# Type a command in the terminal.
Type "php phpunit-slicer slice 4 ./phpunit.xml.dist ./phpunit.xml ./tests"

# Pause for dramatic effect...
Sleep 500ms

# Run the command by pressing enter.
Enter

# Pause for dramatic effect...
Sleep 500ms

# Type a command in the terminal.
Type "cat phpunit.xml | grep testsuite"

# Pause for dramatic effect...
Sleep 500ms

# Run the command by pressing enter.
Enter

# Admire the output for a bit.
Sleep 5

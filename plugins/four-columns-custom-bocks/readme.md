# Four Columns Blocks
Welcome to the Four Columns block library, please enjoy your stay.  
Continue below for a few house keeping rules then get at it.  

## House Keeping
**Since this is a private repo the easiest way to access it is via SSH**  
[Follow this guide on how to do that](https://docs.github.com/en/github/authenticating-to-github/connecting-to-github-with-ssh)  
**DO NOT PUSH TO MASTER UNTIL WE ARE READY FOR A VERSION UPDATE**  

### Building Blocks
Build all blocks in the /blocks folder with their own sub folder.  
We are currently using .scss files inside the blocks folder to contain all the css for that block.  
Import the Scss files in the main styles.scss file in the main directory  
Use [BEM](http://getbem.com/) naming convention for naming blocks.  
Block__Element--Modifier  
Example: .recentPost__readMore--disabled  

### To install 4C Block Plugin and create Local Branch
1.	In Terminal CD in plugins folder
2.	In Terminal, git clone https://github.com/4Columns-Jordan/4C-Block-Library.git
3.	In VS Code, open 4C-Block Library
4.	In VS Code Terminal, run git fetch
5.	In VS Code, go to Source Control, click on 3 dots, click on “Checkout to”, click on “Development Branch”
6.	In VS Code Terminal, run git pull
7.	In VS Code, go to Source Control, click on 3 dots, Branch -> Create Branch (This is to create local branch on computer, only needed first time)


### Before Starting Development in Local Branch
1.  In VS Code, go to Source Control, click on 3 dots, Click on "Checkout To", click on your local branch
2.	In VS Code, go to Source Control, click on 3 dots, click on "Branch”, click on “Merge Branch”, Select "Development Branch"
3.  IN VISUAL STUDIO, INSTALL THE GIT LENS EXTENSION, CAN THEN SEE WHICH BRANCH YOU ARE ON IN BOTTOM LEFT SIDE OF SCREEN

### To Submit Local Branch Changes to Development Branch
1.	In VS Code, go to Source Control
2.	Click on Plus next to “Changes”
3.	Give Commit a descriptive message for change
4.	Click the checkmark above Commit Message
5.	In VS Code, go to Source Control, click on 3 dots, click on “Checkout To”, Click on “Development”
6.	In VS Code Terminal, run git pull
7.  (If Conflicts Exist), go to files, find the files that display a message of “M (Modifed) or “C” (Conflict)
8.	(If Conflicts Exist), If a “M” (Modified) file, nothings needs to be done
9.	(If Conflicts Exist), If a “C” (Conflict file, go to the file and then click on “Accept Both Changes.
10.	(If Conflicts Exist), Click OnPlus Next To Merge Changes
11.	(If Conflicts Exist), Give Commit a descriptive message for change
12.	(If Conflicts Exist), Click the checkmark above Commit Message
13.	In VS Code, go to Source Control, click on 3 dots, Branch -> Merge Branch -> Click on “Local Branch created at beginning
14.	In VS Code, go to Source Control, click on 3 dots, click on Push

From there follow the setps in the [branching out](#branching-out) section.

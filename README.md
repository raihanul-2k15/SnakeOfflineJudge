# Snake Offline Judge
This is an online judge that is made with PHP. This project can be used by school / college coding course tests such as Data Structures, Algorithms, C++ tests for students.

### The word 'Offline' in the name has nothing to do with it's function :D

### This project works in Windows only, however can be modified to work in linux.
### You need GNU G++ compiler installed and path environment variable set to the compiler.

## How it works

Only one coding question can be set at a time.
The data related to the questions (given input, expected output etc) are set in the data/judge directory
Students enter the website, view the question and sample input/output, solves the problem and submit thier C++ code.
Then the website will run the submitted code using G++ compiler and feed the hidden input to test if the answer is correct. The website will also store the code for the teacher to view later.
The submission page will display the results. 
The teacher can also compare two students code to see the degree of match. (Plaguarism check)
Teacher's password set in data/teacher_pass.txt
data/codes and data/submissions directory are managed by the website automatically.

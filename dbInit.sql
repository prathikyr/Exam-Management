CREATE TABLE SUBJECT (
	Subject_ID INT NOT NULL AUTO_INCREMENT,
	Subject_Name VARCHAR(100),
	PRIMARY KEY (Subject_ID)
);

CREATE TABLE COLLEGE (
	College_ID INT NOT NULL AUTO_INCREMENT,
	College_Name VARCHAR(100) NOT NULL,
	College_Address VARCHAR(100),
	College_Contact VARCHAR(50),
	College_Username VARCHAR(50) NOT NULL UNIQUE,
	College_Password VARCHAR(50) NOT NULL,
	PRIMARY KEY (College_ID)
);

CREATE TABLE BRANCH (
	Branch_ID INT NOT NULL AUTO_INCREMENT,
	Branch_College_ID INT REFERENCES COLLEGE(College_ID),
	Branch_Name VARCHAR(100),
	PRIMARY KEY (Branch_ID)
);

CREATE TABLE STUDENT (
	Student_ID INT NOT NULL AUTO_INCREMENT,
	Student_Name VARCHAR(100) NOT NULL,
	Student_Reg_Num VARCHAR(20) NOT NULL,
	Student_Branch INT REFERENCES Branch (Branch_ID),
	Student_College INT REFERENCES COLLEGE(College_ID),
	Student_Date_Of_Birth DATE,
	Student_Username VARCHAR(50) NOT NULL UNIQUE,
	Student_Password VARCHAR(50) NOT NULL,
	PRIMARY KEY (Student_ID)
);

CREATE TABLE EXAM (
	Exam_ID INT NOT NULL AUTO_INCREMENT,
	Exam_Name VARCHAR(100) NOT NULL,
	Exam_Conducting_College INT REFERENCES College (College_ID),
	Exam_Branch INT REFERENCES Branch (Branch_ID),
	Exam_Subject INT REFERENCES Subject (Subject_ID),
	Exam_Time DATETIME,
	PRIMARY KEY (Exam_ID) 
);

CREATE TABLE QUESTION (
	Question_ID INT NOT NULL AUTO_INCREMENT,
	Question_College_ID INT REFERENCES College (College_ID),	
	Question_Branch_ID INT REFERENCES Branch (Branch_ID),
	Question_Subject_ID INT REFERENCES Subject (Subject_ID),
	Question_Description VARCHAR(1000),
	Question_Option1 VARCHAR(100),
	Question_Option2 VARCHAR(100),
	Question_Option3 VARCHAR(100),
	Question_Option4 VARCHAR(100),
	Question_Correct_Answer VARCHAR(100),
	PRIMARY KEY (Question_ID)
);

CREATE TABLE RESULT (
	Result_ID INT NOT NULL AUTO_INCREMENT,
	Result_Student_ID INT REFERENCES Student (Student_ID),
	Result_Exam_ID INT  REFERENCES Exam (Exam_ID),
	Result_Subject_ID INT REFERENCES Subject (Subject_ID),
	Result_Marks_Obtained INT,
	Result_Total_Marks INT,
	PRIMARY KEY (Result_ID)
);

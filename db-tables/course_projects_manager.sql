

CREATE TABLE `courses` (
  `courseID` int(11) NOT NULL,
  `courseName` tinytext NOT NULL
) 

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `projectName` tinytext NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinytext NOT NULL,
  `courseID` int(11) NOT NULL
) 


ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseID`);

ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseID` (`courseID`);


ALTER TABLE `courses`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `projects`
  ADD CONSTRAINT `class_id` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`);
COMMIT;



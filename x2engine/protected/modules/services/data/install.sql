DROP TABLE IF EXISTS `x2_services`;
/*&*/
CREATE TABLE `x2_services` (
	id					INT				NOT NULL AUTO_INCREMENT PRIMARY KEY,
	createDate			BIGINT,
	lastUpdated			BIGINT,
	updatedBy			VARCHAR(50),
	description			TEXT,
	contactId			varchar(250),
	assignedTo			TEXT,
	name				VARCHAR(255),
	impact				VARCHAR(40),
	status				VARCHAR(40),
	subject				TEXT,
	mainIssue			VARCHAR(40),
    email               VARCHAR(255),
	nextAction			TEXT,
	resolution			TEXT,
	subIssue			VARCHAR(40),
	origin				VARCHAR(40),
	escalatedTo			VARCHAR(50),
	lastActivity		BIGINT,
	parentCase			INT
) COLLATE = utf8_general_ci AUTO_INCREMENT = 1000;
/*&*/
INSERT INTO `x2_modules`
			(name,				title,			visible, 	menuPosition,	searchable,	editable,	adminOnly,	custom,	toggleable)
	VALUES	("services",		"Service",		1,			4,				1,			1,			0,			0,		0);
/*&*/
INSERT INTO x2_fields
(modelName,			fieldName,				attributeLabel,			modified,	custom,	type,					required,	readOnly,	linkType,   	searchable,	isVirtual,	relevance, uniqueConstraint, safe)
VALUES
("Services",		"id",					"Case",					0,			0, 		"varchar",				0, 			0, 			NULL,			1,			0,			"",			1,                  1),
("Services",		"createDate",			"Create Date",			0,			0, 		"dateTime",				0, 			1, 			NULL,			0,			0,			"",			0,                  1),
("Services",		"lastUpdated",			"Last Updated",			0,			0, 		"dateTime",				0, 			1, 			NULL,			0,			0,			"",			0,                  1),
("Services",		"updatedBy",			"Updated By",			0,			0, 		"varchar",				0, 			1, 			NULL,			0,			0,			"",			0,                  1),
("Services",		"description",			"Description",			0,			0, 		"text",					0, 			0, 			NULL,			1,			0,			"Medium", 	0,                  1),
("Services",		"contactId",			"Contact",				0,			0, 		"link",					0, 			0, 			'Contacts', 	0,			0,			"",			0,                  1),
("Services",		"assignedTo",			"Assigned To",			0,			0, 		"assignment",			0, 			0, 			NULL, 			0,			0,			"",			0,                  1),
("Services",		"impact",				"Impact",				0,			0, 		"dropdown",				1, 			0, 			'108', 			0,			0,			"",			0,                  1),
("Services",		"status",				"Status",				0,			0, 		"dropdown",				1, 			0, 			'109', 			0,			0,			"",			0,                  1),
("Services",		"subject",				"Subject",				0,			0, 		"varchar",				0, 			0, 			NULL, 			0,			0,			"",			0,                  1),
("Services",		"email",				"Email",				0,			0, 		"email",				0, 			0, 			NULL, 			0,			0,			"",			0,                  1),
("Services",		"mainIssue",			"Main Issue",			0,			0, 		"dropdown",				0, 			0, 			'110', 			1,			0,			"",			0,                  1),
("Services",		"nextAction",			"Next action",			0,			0, 		"text",					0, 			0, 			NULL, 			0,			0,			"",			0,                  1),
("Services",		"resolution",			"Resolution",			0,			0, 		"varchar",				0, 			0, 			NULL, 			0,			0,			"",			0,                  1),
("Services",		"subIssue",				"Sub Issue",			0,			0, 		"dropdown",				0, 			0, 			'111', 			0,			0,			"",			0,                  1),
("Services",		"origin",				"Case Origin",			0,			0, 		"dropdown",				0, 			0, 			'112', 			0,			0,			"",			0,                  1),
("Services",		"escalatedTo",			"Escalated To",			0,			0, 		"optionalAssignment",	0, 			0, 			NULL, 			0,			0,			"",			0,                  1),
("Services",		"lastActivity",			"Last Activity",		0,			0, 		"dateTime",				0, 			1, 			NULL, 			0,			0,			"",			0,                  1),
("Services",		"parentCase",			"Parent Case",			0,			0, 		"link",					0, 			0, 			'Services', 	1,			0,			"",			0,                  1);

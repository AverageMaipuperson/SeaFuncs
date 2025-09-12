# SeaFuncs v1.1

## Changelog:
- Improved design
- Added color coding
- Syntax has been replaced to a more simpler one
- Added function overview
- Added EXISTS function
- Added the capability to unrate levels using the RATE function
- Small bug fixes

# TUTORIAL

## Basic Syntax
A SeaFuncs function has this specific structure:
    
**FUNCTION** type param1 param2



## List of functions

### 1. GET
The GET function's purpose is to retrieve values from the database.
**Types:**
1. levelid
In this case, param1 will be the level name. It retrieves the level id.

2. levelname
In this case, param1 will be the level id. It retrieves the level name.

3. userid (uid)
In this case, param1 will be the username. It retrieves the user id.

4. comments
In this case, param1 will be the level id. It retrieves the comment count of the level.

5. stats
In this case, param1 will be the level id. It retrieves the likes and comments of a level.

6. accountid (accid)
In this case, param1 will be the username. It retrieves the account id.

### 2. UPDATE
The UPDATE function's purpose is to update values in the database.
**Types:**
1. levelname
In this case, param1 will be the level id and param2 will be the new name.

2. admin
In this case, param1 can be either *on* or *off*, param2 will be the accountid.

### 3. RATE
The RATE function simply rates (or unrates) any level.
**Parameters:**
1. level id
Level ID of the level you want to rate.

2. starrate
How many starts you will give the level (unrate if 0)

3. type
Rate type, not required.

### 4. EXISTS
The EXISTS function will either leave true or false depending whetever the input exists or not.
**Types:**
1. level
In this case, param1 will be the level id.

2. comment
In this case, param1 will be the comment id.


# EXAMPLES

**GET** levelname 231 **||** Output: "TEST"
**GET** userid nanoalt **||** Output: 21
**EXISTS** comment 100 **||** Output: false





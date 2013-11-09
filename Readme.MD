
**API request routes**
=======================

http://www.spotton.co/web/api.php - base

**GET**

/getUniList

/getLocationList/{universityId}

/getSpot/{spotId}

/getComment/{commentId}

/getTop/{numberOfDays}

/getLatest/{numberOfDays}

/getTopComments/{spotId}

/getLatestComments/{spotId}


**POST**

/addSpot

	-	latitude:
	-	longitude:
	-	message:
	- 	locationID:
	-	universityID:

/validateLocation

	-	latitude:
	-	longitude:
	- 	locationID:
	-	universityID:

/addComment

	-	message:
	-	spotId:



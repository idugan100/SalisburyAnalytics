# Console Commands
This documentation is meant to give a short overview of how to use the various command line tools that have been built to run the site.

## Get Rate My Professor Links
This command allows you to populate/repopulate the rate my professor links that can be found in the professors database in the rmp_link and can be viewed via an iframe on the professor card.
|  | |
| ------------------|------------------|
| Command Signature | php artisan populate:rmp-links |
| Command Description | Repopulates Rate my Professor links using either Google Scraping or SerpAPI |
| Options | The command will ask to either use google search api or SerpAPI |
| File | GetRMPLinks.php |

### Google Search API
This API is much cheaper and charges per request. However, it is much less accurate and only found ~ 25% of the links. In order to use this you will need to set GOOGLE_CUSTOM_SEARCH_KEY and GOOGLE_CUSTOM_SEARCH_ENGINE_ID in your .env file. Further documentation of this API can be found [here](https://developers.google.com/custom-search/v1/overview).

### Serp API
This API is much more expensive and has a usage tier pricing model. I've used the $50 a month tier before and it worked very well, finding pages for ~70% of the professors. In order to use this drive you will need to set SERP_API_KEY value in you .env file. The site can be found [here](https://www.searchapi.io); 

## Import Data
This command pulls data from an excel file and inserts it into the courses, professors, and courses_x_professors_with_grades. This is how I insert the excel file I get from the PIA request into the database. I would suggest checking for empty lines or unexpected values in the excel file before running this script. The command uses the package [Box\Spout](https://opensource.box.com/spout/docs/).
|  | |
| ------------------|------------------|
| Command Signature | php artisan import:data |
| Command Description | command to import data from an excel file into the database |
| Options | the commmand will prompt for the path to the excel file, confirm that the found headers are correct, and ask for course name and description information |
| File | ImportData.php |

A database commit occurs after each and every line is processed. If the course, professor, or grade crossover is found to be a duplicate it will be skipped and not inserted again.

## Calculate Course Statistics
This command recalculates and repopulates the statistical values listed below on the course table which are used in various reporting functionality over the site. We are doing this to increase performance. Calculating this for all of the courses each time they appear on screen is slow. Because the data is infrequentely updated, we can have a script that updates the calculated fields whenever we upload new data.
- Average GPA
- Total Enrollment
- A Rate
- B Rate
- C Rate
- D Rate
- F Rate
- W Rate

All rates are rounded to the nearest whole percent and are whole number representations of the percents (14 for 14%). Average GPA is rounded to the hundreths place.
|  | |
| ------------------|------------------|
| Command Signature | php artisan populate:course-stats |
| Command Description | recalculate all statistics for courses |
| Options | none |
| File | calculate_course_stats.php |

## Calculate Professor Statistics
This command recalculates and repopulates the statistical values listed below on the professor table which are used in various reporting functionality over the site.
- Average GPA
- Total Enrollment
- A Rate
- B Rate
- C Rate
- D Rate
- F Rate
- W Rate

All rates are rounded to the nearest whole percent and are whole number representations of the percents (14 for 14%). Average GPA is rounded to the hundreths place.
|  | |
| ------------------|------------------|
| Command Signature | php artisan populate:professor-stats |
| Command Description | recalculate all statistics for professors |
| Options | none |
| File | calculate_professor_stats.php |

<p align="center">
    <img src="./public/gully-removebg-preview.png" width="250" style="">
</p>


![Lint](https://github.com/idugan100/SalisburyAnalytics/actions/workflows/lint.yml/badge.svg)
![Tests](https://github.com/idugan100/SalisburyAnalytics/actions/workflows/test.yml/badge.svg)
![Static Analysis](https://github.com/idugan100/SalisburyAnalytics/actions/workflows/staticanalalysis.yml/badge.svg)



<h1 style="text-align: center;margin-top:20px;">Salisbury Analytics</h1>

## About
Salisbury Analytics is a web application built for the students of Salisbury University. It utilizes aggregate grade information obtained via the Public Information Act to provide informative grade visualizations. It ingests data from the Department of Education api to provide reports about student demographics. Data is scraped from Coursicle and Rate My Professor to provide professor reviews and accurate course times. A retrival augmented LLM provides a natural language interface to the university website. You can visit Salisbury Analytics [here](https://salisburyanalytics.com).

## Motivation
Education is a major investment of time, money and effort. Salisbury Analytics aims to support students of Salisbury Univesity in getting the highest return on their investment by helping them make informed decisions. Additionally, the website acts as a tool to keep the university accountable by improving transparency.

## Technology
Architecture diagram can be found [here](./documentation/Salisbury%20Analytics%20Architecture.pdf).
|  | |
| ------------------|------------------|
| Front End | Blade, HTMX, Apex Charts, Javascript, LangChain.js |
| Styling | Tailwind, FlowBite |
| Back End | PHP, Laravel |
| Database | MYSQL |
| Testing | PHPUnit |
| Static Analysis | PHPStan |
| Linting | Pint |
| Hosting | AWS EC2 |
| Uptime Monitoring | Status Cake |
| Payments | Stripe |



select count(*) as `unique_visitors` from(
select count(*)
from user_details 
group by ip_address, ) as `ip` ;
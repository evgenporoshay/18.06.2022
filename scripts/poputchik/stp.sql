-- stp
SELECT VALUE_ID
from b_crm_deal
JOIN b_uts_crm_deal on
b_uts_crm_deal.VALUE_ID = b_crm_deal.id
where STAGE_ID = 'C34:NEW'

-- --admin
SELECT VALUE_ID
from b_crm_deal
JOIN b_uts_crm_deal on
b_uts_crm_deal.VALUE_ID = b_crm_deal.id
where STAGE_ID = 'C34:PREPARATION'

-- orpo
SELECT VALUE_ID
from b_crm_deal
JOIN b_uts_crm_deal on
b_uts_crm_deal.VALUE_ID = b_crm_deal.id
where STAGE_ID = 'C34:1'

-- product
SELECT VALUE_ID
from b_crm_deal
JOIN b_uts_crm_deal on
b_uts_crm_deal.VALUE_ID = b_crm_deal.id
where STAGE_ID = 'C34:3'
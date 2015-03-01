INSERT INTO `application_discounts`(`application_id`, `membership_level_id`, `discount`) 
VALUES 
(
    (SELECT application_id FROM applications WHERE application_key = 'remuneration'),
    (SELECT membership_level_id FROM membership_levels WHERE membership_level_key = 'first'),
    0
),
(
    (SELECT application_id FROM applications WHERE application_key = 'remuneration'),
    (SELECT membership_level_id FROM membership_levels WHERE membership_level_key = 'second'),
    1
),
(
    (SELECT application_id FROM applications WHERE application_key = 'remuneration'),
    (SELECT membership_level_id FROM membership_levels WHERE membership_level_key = 'third'),
    1
)
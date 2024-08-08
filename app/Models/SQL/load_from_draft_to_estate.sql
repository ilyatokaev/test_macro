insert into estate (
                    source_instance_code
                    , address
                    , price
                    , rooms
                    , floor
                    , house_floors
                    , description
                    , contact_id
                    , manager_id
)
select draft.estate_code
     , draft.estate_address
     , draft.estate_price
     , draft.estate_rooms
     , draft.estate_floor
     , draft.estate_house_floor
     , draft.estate_description
     , c.id
     , ma.id
from etl_draft_input_data draft
    inner join agency a on a.source_instance_code = draft.agency_code
    inner join manager ma on ma.source_instance_code = draft.manager_code AND ma.agency_id = a.id
    inner join contacts c on c.source_instance_code = draft.contact_phone
where draft.estate_code not in
    (
        select e.source_instance_code
        from estate e
    )

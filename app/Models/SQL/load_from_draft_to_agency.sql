insert into agency (name, source_instance_code)
select draft.agency_code, draft.agency_code
from etl_draft_input_data draft
where draft.agency_code not in
    (
        select source_instance_code
        from agency
        group by source_instance_code
    )
group by draft.agency_code
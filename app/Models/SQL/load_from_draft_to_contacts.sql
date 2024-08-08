insert into contacts (name, phones, source_instance_code)
select max(draft.contact_name), draft.contact_phone, draft.contact_phone
from etl_draft_input_data draft
where draft.contact_phone not in
    (
        select source_instance_code
        from contacts
        group by source_instance_code
    )
group by draft.contact_phone
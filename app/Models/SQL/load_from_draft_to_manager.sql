insert into manager (agency_id, name, source_instance_code)
select a.id, draft.manager_code, draft.manager_code
from etl_draft_input_data draft
    inner join agency a on a.source_instance_code = draft.agency_code
where draft.manager_code not in
    (
        select m.source_instance_code
        from manager m
        where m.agency_id = a.id
        group by m.source_instance_code
    )
group by a.id, draft.manager_code
update contacts t
set t.name = (
    select max(s.contact_name)
    from etl_draft_input_data_for_update s
    where s.contact_phone = t.source_instance_code
    group by s.contact_phone
)
where t.source_instance_code in (
    select s2.contact_phone
    from etl_draft_input_data_for_update s2
    )

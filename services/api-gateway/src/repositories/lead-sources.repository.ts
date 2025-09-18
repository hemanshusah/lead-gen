import {inject} from '@loopback/core';
import {DefaultCrudRepository} from '@loopback/repository';
import {PostgresDataSource} from '../datasources';
import {LeadSources, LeadSourcesRelations} from '../models';

export class LeadSourcesRepository extends DefaultCrudRepository<
  LeadSources,
  typeof LeadSources.prototype.id,
  LeadSourcesRelations
> {
  constructor(
    @inject('datasources.Postgres') dataSource: PostgresDataSource,
  ) {
    super(LeadSources, dataSource);
  }
}

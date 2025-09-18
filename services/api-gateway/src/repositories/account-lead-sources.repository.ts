import {inject} from '@loopback/core';
import {DefaultCrudRepository} from '@loopback/repository';
import {PostgresDataSource} from '../datasources';
import {AccountLeadSources, AccountLeadSourcesRelations} from '../models';

export class AccountLeadSourcesRepository extends DefaultCrudRepository<
  AccountLeadSources,
  typeof AccountLeadSources.prototype.id,
  AccountLeadSourcesRelations
> {
  constructor(
    @inject('datasources.Postgres') dataSource: PostgresDataSource,
  ) {
    super(AccountLeadSources, dataSource);
  }
}

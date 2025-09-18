import {inject} from '@loopback/core';
import {DefaultCrudRepository} from '@loopback/repository';
import {PostgresDataSource} from '../datasources';
import {JobRuns, JobRunsRelations} from '../models';

export class JobRunsRepository extends DefaultCrudRepository<
  JobRuns,
  typeof JobRuns.prototype.id,
  JobRunsRelations
> {
  constructor(
    @inject('datasources.Postgres') dataSource: PostgresDataSource,
  ) {
    super(JobRuns, dataSource);
  }
}
